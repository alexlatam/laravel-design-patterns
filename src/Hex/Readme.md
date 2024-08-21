# Hexagonal Architecture folder structure

## Introduction
This document describes the folder structure of a Hexagonal Architecture project.

## Folder structure
```
src
└── Hex
    ├── BoundedContexts
    │   └── Modules
    │        ├── Domain
    │        │   ├── Entities
    │        │   ├── Repositories
    │        │   ├── Exceptions
    │        │   ├── ValueObjects
    │        │   ├── ValueObjects
    │        │   └── Contracts
    │        ├── Infrastructure
    │        │   ├── Persistence
    │        │   └── Service
    │        └── Application
    │            └── ApplicationServices[Use Cases]
    ├── Backoffice[Bounded Context]
    │   └── Posts [Module]
    │       ├── Domain
    │       │   ├── Entities
    │       │   ├── Repositories
    │       │   ├── Exceptions
    │       │   ├── ValueObjects
    │       │   ├── ValueObjects
    │       │   └── Contracts
    │       ├── Infrastructure
    │       │   ├── Controllers
    │       │   ├── Persistence
    │       │   ├── Routes
    │       │   └── Service
    │       └── Application
    │           └── ApplicationServices[Use Cases]
    └── Shared
        ├── Domain
        │   ├── Model
        │   └── Repository
        ├── Infrastructure
        │   ├── Controller
        │   ├── Persistence
        │   └── Service
        └── Application
            └── ApplicationServices[Use Cases]    
```
