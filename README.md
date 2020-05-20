![PHP Composer](https://github.com/jeyroik/extas-values-repository-items/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-values-repository-items/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/extas-values-repository-items/maintainability"><img src="https://api.codeclimate.com/v1/badges/0b109ba13e110eb298e5/maintainability" /></a>

# Описание

Пакет предоставляет обработчик значения "данные из реопзитория".

# Использование

`extas.json`
```json
{
  "items": [
    {
      "name": "test",
      "value": {
        "repository": "pluginRepository",
        "method": "all",
        "query": {"class": "test"},
        "field": ""
      }    
    }
  ]
}
```
```php
$repoValue = new \extas\components\values\RepositoryValue($item->getValue());
if ($repoValue->isValid()) {
    $values = $repoValue->buildValue();
}
```
