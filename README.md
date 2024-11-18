To deploy:
1. Build Docker image
```bash
docker build -t your-registry/php-todo-app:latest .
docker push your-registry/php-todo-app:latest
```

2. Apply Kubernetes configs
```bash
kubectl apply -f k8s/
```