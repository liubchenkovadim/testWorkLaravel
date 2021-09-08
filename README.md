## MYSQL

### задача 1 

1.Для заданного списка товаров получить названия всех категорий,
в которых представлены товары.
Выборка для нескольких товаров (пример: ids = (9, 14, 6, 7, 2)).

    SELECT c.name
    FROM category c
    LEFT JOIN product p on c.id = p.category_id
    WHERE p.id IN (9, 14, 6, 7, 2);

 Схема картинка  img/mysqldiagram-1.png
 
### задача 2
2.Для заданной категории получить список предложений всех
товаров из этой категории. Каждая категория может иметь
несколько подкатегорий.
Пример:
Выбираю все товары из категории компьютеры (id = 2) и подкатегории
(id =3 (ноутбуки), id = 4 (планшеты), id = 5 (гибриды)).

    SELECT name, id
    FROM product
    WHERE category_id IN (
    SELECT id
    FROM category
    WHERE id = 2 OR parent_id =2
    );

Схема картинка  img/mysqldiagram-1.png

### задача 3
3.Для заданного списка категорий получить количество уникальных
товаров в каждой категории.
Выборка для нескольких категорий (пример: ids = (2, 3, 4) ).

    SELECT c.name AS category, count(*) AS count
    FROM product AS p
    INNER JOIN category c ON p.category_id = c.id
    WHERE p.category_id IN (2, 3, 4)
    GROUP BY p.category_id;

Схема картинка  img/mysqldiagram-1.png

### задача 4
4.Для заданного списка категорий получить количество единиц
каждого товара который входит в указанные категории.
Выборка для нескольких категорий (пример: ids = (3, 4, 5) ).

    SELECT quantity
    FROM product
    WHERE category_id IN (3,4,5);

Схема картинка  img/mysqldiagram-4.png
