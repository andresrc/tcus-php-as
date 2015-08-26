# PHP Architectural Struggle

This repository contains a solution for the PHP Architectural Struggle.

As stated in the assessment statement, no external library or framework has been used
to develop the solution. The only external components included are:
- PHPUnit, for unit testing.
- Guzzle, to support unit testing of the REST interface.
- Composer, to manage the previous dependencies and provide PSR-4 (supersedes PSR-0) autoloading.

## Architecture. Layers.

The solution is structured in the following layers.

### Model

The model contains the domain objects used, in this case the `Address` object (maybe another name such as `Contact` would have been more appropiate
but the same used in the statement is used).

### Data

The data layer provide the repositories to manage persistence of the domain objects. Interface-oriented design is used.
In order to make the solution self-contained, avoiding dependencies on databases, etc. a simple file-based solution has been 
developed (without any focus on performace).

Basic concurrency and transaction support is included in order to make it usable and illustrate transaction demarcation from the service layer.

### Service

The service layer, which also uses interface-oriented design, is responsible for bussiness logic (not much in this case) and unit-of-work demarcation (using transactions).

### Module Abstraction

A module abstraction is included to centralize the wiring of the different elements that compose each layer (data, service and controllers, part
of the MVC layer, described below). This could be the responsibility taken by a dependency injection framework in other contexts.
Modules are built during bootstrap using the provided configuration.


### MVC "nano-engine"

A custom MVC solution is developed to export the service layer as a restful web service. Each module "mounts" controllers, reserving a piece 
of URI namespace, and the set of provided controllers form an application, which is also prepared during bootstrap.

The MVC application provides request and reponse abstraction, controller-level routing and dispatching. View negotiation would be also part of the
responsibilities, though in this case only a JSON output handler is included.


