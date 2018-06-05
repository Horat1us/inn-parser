# Inn (tax reference number) Parser (Ukraine)

[![Build Status](https://travis-ci.org/Horat1us/inn-parser.svg?branch=master)](https://travis-ci.org/Horat1us/inn-parser)
[![codecov](https://codecov.io/gh/horat1us/inn-parser/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/inn-parser)

Simple parser that allows to decode ukranian tax reference number information

Парсер позволяет расшировывать ИНН (Украина) для получения даты рождения, пола и контрольной суммы.

## Installation
Using composer:
```bash
composer require horat1us/inn-parser
```

## Usage

```php
<?php

use Horat1us\Inn;

$inn = 3184710691;

$parser = new Inn\Parser($inn);
$info = $parser->parse();

$info->isValid(); // is control sum match
$info->getGender(); // male
$info->getBirthDate(); // \DateTime
$info->getBirthDate()->format('Y-m-d'); // 1987-03-12
```

## Contributors
- [Alexander Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
