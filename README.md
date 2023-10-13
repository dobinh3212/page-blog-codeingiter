#### Config file env
- `copy từ env sang file .env`
#### Chạy docker 
- `docker compose up --build`
#### Truy cập container
- `docker exec -it project-root-app-1 bash`
#### Chạy ngrok authtoken
- `ngrok authtoken 2We2mMyTuFQT2zzAQv16UazVGLP_61k5RbP6xRSLdkqfZqCpP`
#### Chạy ngrok http để mở cổng kết nối từ localhost sang ngrok
- `ngrok http 8080`