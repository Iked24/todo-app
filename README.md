# To-Do List App

Простое веб-приложение "Список задач", написанное на PHP, с использованием Redis для хранения данных и Docker Compose для контейнеризации. Позволяет добавлять задачи и отображать их в удобном списке.

## Описание

Это приложение предоставляет базовый функционал для управления задачами:
- Добавление новых задач через веб-форму.
- Отображение списка задач с чекбоксами состояния (выполнено/не выполнено).
- Хранение данных в Redis с сохранением между перезапусками благодаря Docker-томам.

Приложение работает в контейнерах Docker, что упрощает развертывание и тестирование.

## Технологии

- **PHP 8.2** — серверный язык для логики приложения.
- **Apache** — веб-сервер для обработки запросов.
- **Redis** — быстрое in-memory хранилище для задач.
- **Docker & Docker Compose** — контейнеризация и оркестрация.

## Структура проекта

todo-app/
├── index.php          # Основной файл приложения (логика и интерфейс)
├── Dockerfile         # Конфигурация контейнера PHP+Apache
└── docker-compose.yml # Конфигурация Docker Compose
