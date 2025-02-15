# yii-app

Тестовый pet-проект на базе Yii2 в докер-контейнерах для работы с сервисом openexchangerates.org
Страница сайта доступна по адресу: http://localhost:82/
(82 порт - чтобы избежать конфиликтов с занятым 80 портом)

Для удобства тестирования - добавл кнопку с на странице http://localhost:82/index.php по клике на которую выполняется запрос котировок.

## Запуск в локальном окружении
- `bash deploy.sh` - для запуска автоматического развертывания проекта с миграциями и созданием пользователя admin/admin

## Прочие команды
- `docker compose up -d` - для запуска проекта в контейнерах
- `docker compose down --remove-orphans` - для остановки докер-контейнеров 
- `docker exec -it yii_php bash` - для входа в контейнер или запустите скрипт `run-bash.sh`

### Рестарт Nginx
`docker exec -w ./ yii_nginx nginx -s reload`

### Миграции
Миграции можно откатить с помощью `php yii migrate/down all`
Другие команды:
- `php yii migrate/down` -отменяет самую последнюю применённую миграцию
- `php yii migrate/down 3` -отменяет 3 последних применённых миграции
- `php yii migrate/redo` - перезагрузить последнюю применённую миграцию
- `php yii migrate/redo 3` - перезагрузить 3 последние применённые миграции

# Сброс проекта
`bash reset.sh` - для отката миграций, остановки докер-контейнеров и удаления зависимостей в папке vendor
