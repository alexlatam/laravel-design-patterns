# Command Handler With Command Bus

Un Command Hanlder no es mas que un caso de uso o un servicio que se encarga de orquestrar la logica de negocio de un comando.
Recibe un Commando (una clase plana de PHP) y delega la ejecucion de la logica de negocio al dominio ( ya sea la entidad, servicio de dominio etc).

Un Command Bus es una clase que mapea un comando a un Command Handler.
Por cada comando que se envie, el Command Bus busca el Command Handler correspondiente y lo ejecuta.
Solo hay un Command Bus por aplicacion, y es el encargado de recibir todos los comandos y delegar su ejecucion al Command Handler correspondiente.
Solo existe un solo Command por Command Hanlder.
