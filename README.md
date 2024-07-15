### Реализация автозагрузки PSR-4
___
#### About

Простая реализация автозагрузки PSR-4.

Позволяет загружать классы без использования `require` и т.п.


#### How-to-use

- Использовать `require autoload.php` в том файле, где должна работать автозагрузка.

### Рубрика "Эксперименты"
- `index.php` - файл "клиент", будет "пробовать" создать класс.
- `autoload.php` - файл с логикой автозагрузки.
- `config.json` - конфигурационный файл, в котором нужно указать название корневого namespace`а и соотвествующую ему директорию в проекте.

Файл `index.php` создает объект типа `Clazz`. Директива `use` в начале файла нужна для чистоты кода, поэтому неважно как именно будет указано имя класса:

- `use ParentNamespace\Subdir\Clazz; new Clazz()`
- или `new ParentNamespace\Subdir\Clazz()`

Ведь в обоих случаях в функцию автозагрузки попадет `ParentNamespace\Subdir\Clazz`.

Далее функция автозагрузки делит полученное полное имя класса на элементы массива с разделителем '\'.

Затем запускается цикл по тем родительским namespace\`ам, которые указаны в конфиге. 
Если загружаемый класс (e.g. `ParentNamespace\Subdir\Clazz`) относится к итерируемому namespace\`у (e.g. `ParentNamespace`) - получаем соотвествующее родительскому namespace\`у 
значение из конфига `src` - то есть расположение этого namespace\`а в проекте.

Потом добавляем к полученному значению относительный путь к файлу класса, то есть `Subdir\Clazz`
и получается `src/Subdir/Clazz`.

### Рубрика "Частые вопросы от пользователей"

- PHPStorm не видит корневую директорию с классами или пытается найти другую. Решение:

`CTRL + ALT + S` `->` `Directories`. Далее выбираем папку, в которой будут
  находится классы, помечаем её как `Sources Root` и устанавливаем в качестве Package Prefix ту директорию, в которой будут хранится классы,
если по какой-то причине это не произошло автоматически.