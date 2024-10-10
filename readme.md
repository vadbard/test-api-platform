Подготовить бэкенд на основе Symfony 6 + Api Platform 3, реализующий REST API для данных из таблиц БД Postgres / Mysql.

    Parent:
    id — primary key
    name

    Children
    id — primary key
    parent_id — foreign key to parent.id
    name

Api должно обеспечивать
1. Маппинг таблиц на  api endpoints
2. Методы GET (для коллекции и для элемента), POST, PATCH, DELETE
3. Методы GET /parent… должны предоставлять возможность, кроме полей id и name, вернуть поле childCount — количество элементов Children дочерних текущему.
4. Методы POST и PATCH /parent должены предоставлять возможность сохранения коллекции дочених элементов Children

Систему запускать в проекте docker compose с необходимыми сервисами (БД + бэкенд), фронт не требуется.

Проект оформить в виде публичного  репозитория на доступных площадках или в виде архива.