<?php

namespace App\Http\Controllers\Api;
use App\ApplicationServices\UpdateReviewApplicationService;
use App\Enums\ReviewEvents;
use App\Http\Controllers\Controller;
use App\Repositories\ReviewRepository;
use Exception;
use Illuminate\Events\Dispatcher;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

/**
 * Command Bus que se encarga de ejecutar los comandos en sus respectivos command handlers
 * Este Command Bus se uno basico, la idea es entender como funciona un CommandBus
 * Lo que hace es mapear, mediante un array asociativo[Hash Map], los comandos con sus respectivos command handlers
 */
class CommandBus
{
    public function __construct(private array $handlers = [])
    {
    }

    public function addHandler($commandName, $handler): void
    {
        $this->handlers[$commandName] = $handler;
    }

    /**
     * @throws Exception
     */
    public function handle($command): mixed
    {
        $commandName = get_class($command);
        $handler = $this->handlers[$commandName];
        if(is_null($handler)) {
            throw new Exception("No handler for command $commandName");
        }
        return $handler->handle($command);
    }

    public function addDecorator()
    {
    }
}

/**
 * En el boostraping de la aplicacion se deberia registrar los command handlers en el command bus
 * Esto se puede hacer en el Service Container [AppServiceProvider]
 * $commandBus = new CommandBus();
 * $commandBus->addHandler(PublishArticleCommand::class, new PublishArticleCommandHandler($userRepository, $postRepository));
 *
 */


/**
 * Controlador que recibe los valores del request y crea el commando
 * Luego lo envia al command bus para que lo ejecute
 */
final class UpdateBlogPostController extends Controller
{
    /**
     * @throws Exception
     */
    public function update(int $review_id, array $data = [])
    {
        /**
         * Estas dependencias deberina inyectarse en el constructor de la clase.
         * En ulitma instancia en el contructor del Application ServiceN
         */
        $reviewRepository = new ReviewRepository();
        $eventDispatcher = new Dispatcher();
        $logger = new Log();
        $notifier = new ChannelManager(container: app());

        /**
         * Agrego un listener al event dispatcher para que cuando se dispare el evento ReviewUpdated
         * se guarde un log de la review actualizada.
         * Este enlace entre el evento y el listener se puede hacer tambien en el Service Container.
         */
        $eventDispatcher->listen(ReviewEvents::ReviewUpdated->value, function (Event $event) use ($logger) {
            $review = $event->getReview();
            $logger->log('info', 'Review updated', ['review_id' => $review->id]);
        });

        /**
         * Agrego un listener al event dispatcher para que cuando se dispare el evento ReviewUpdated
         * Se notifique a los usuarios que esten suscriptos a la review.
         * Este enlace entre el evento y el listener se puede hacer tambien en el Service Container.
         */
        $eventDispatcher->listen(ReviewEvents::ReviewUpdated->value, function (Event $event) use ($notifier) {
            $review = $event->getReview();
            $notifier->notifyReviewUpdated($review);
        });

        /**
         * Enviamos el Command al command bus para que lo ejecute
         */
        $commandBus->handle(new PublishArticleCommand($request->get('user_id'), $request->get('article_id')));

        return (new UpdateReviewApplicationService(
            $reviewRepository,
            $eventDispatcher,
        ))->execute($review_id, $data);
    }
}
