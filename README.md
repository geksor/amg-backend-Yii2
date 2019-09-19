- **Используем  ISPmanager**    
Создаем пользователя и из под него размещаем проэкт.
Добавляем для домена  DNS запись тип A с IP адресом сервера.

- **Устанавливаем supervisor**  
**команда установки:** apt-get install supervisor   
**фаил конфигурации:** /etc/supervisor/supervisord.conf     
**добавляем:**
    ```
    [program:websocket]     
    command=/usr/bin/php /путь к проэкту/yii server/start      
    numprocs=1  
    stdout_logfile=/var/log/websocket.log   
    autostart=true  
    autorestart=true    
    user=www-data   
    stopsignal=KILL  
    ``` 
    **создаем крон задачу на выполнение при загрузке сервера с командой:** /etc/init.d/supervisor start

- **Настройки mySql**   
**в файле:** /etc/mysql/mysql.conf.d/mysqld.cnf     
**добавляем в раздел [mysqld]:**        
    ```
    wait_timeout = 31536000     
    interactive_timeout = 31536000      
    ```
- **В проекте меняем все IP адреса и порты для websocket**