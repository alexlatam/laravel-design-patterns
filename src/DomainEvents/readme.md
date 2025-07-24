
### Flujo de Publicacion de Eventos y Suscriptores a los eventos
Controller (Infra) → CommandBus (Domain interface) → CommandHandler (Application) → Use Case (Application)

Consumer (Infra) → Mapa (infrastructure) → Event Subscriber (Application) → Use Case (Application)
