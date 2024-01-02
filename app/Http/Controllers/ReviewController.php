<?php

namespace App\Http\Controllers;
use App\ApplicationServices\UpdateReviewApplicationService;
use App\Enums\ReviewEvents;
use App\Repositories\ReviewRepository;
use Exception;
use Illuminate\Events\Dispatcher;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

final class ReviewController extends Controller
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

        return (new UpdateReviewApplicationService(
            $reviewRepository,
            $eventDispatcher,
        ))->execute($review_id, $data);
    }
}
