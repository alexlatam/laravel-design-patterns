# Hexagonal Simple Example [Tax Calculator]


- Puerto Primario: [ForCalculatingTaxes]
- Puerto Secundario: [ForGettingTaxRates]
Este puerto secundario es una interfaz que sera implementada por los repositorios.
- Configurador: [TaxesController]
Aqui es donde se crean las instancias de los objetos que necesita el caso de uso.

TaxCalculatorService implementa el Puerto Primario y usa el Puerto Secundario
