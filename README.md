# Electronic Items

A repository to display my skills and understanding of the PHP language so far.

## Table of contents
* [Setup](#setup)
* [Project Structure](#project-structure)
* [Usage](#usage)
* [License](#license)

## Setup
There is no setup required in order to run this project other than cloning the repository and
installing dependencies.

```shell
~ git clone git@github.com:rafmjr/electronick.git
~ cd electronick
~ composer install
```

## Project Structure

Here is a description of this project structure, hoping to ease the assessment:

```
Directory                               Description
├── src                                 
│   ├── Exceptions                      Domain specific exceptions
│   ├── Models                          Entities reprenting business logic
│   └── Traits                          For horizontal composition
├── tests
│   ├── Features                        Implementations of the scenarios described
│   └── Unit                            Implementation of subtasks
├── vendor
├── .gitignore
├── composer.json
├── composer.lock
├── LICENSE
└── README.md
```

## Usage
In the document provided there were mainly two questions describing scenarios in which the source
code in this project should be used. In order to reproduce such scenarios, it was decided to create
a Feature Test: **ElectronicItemsPurchaseTest**.

In the two questions mentioned above, there were other subtasks implied such as the implementation
of a method to limit the number of extras for a given **ElectronicItem**. Those subtasks and any other
considerations made by the developer were included in the Unit Tests.  

In order to run the tests, execute the following command:
```shell
~ vendor/bin/phpunit .
```

## License
This project is licensed under the terms of the **Apache** license.
