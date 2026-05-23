# Entitas Yang Perlu Disiapkan di dalam Database #
users
roles
permissions

stores

categories
products
product_stocks

customers
suppliers

sales
sale_items
payments

purchases
purchase_items

stock_movements

audit_logs

## Relasi Tabelnya ##

users
------
id
name
email
password

roles
------
id
name

user_roles
-----------
user_id
role_id


stores
--------
id
name
address


categories
------------
id
name


products
---------
id
category_id
sku
name
price
cost_price
barcode


product_stocks
--------------
id
store_id
product_id
qty


customers
---------
id
name
phone


suppliers
---------
id
name
phone


sales
------
id
invoice_number
customer_id
store_id
user_id
subtotal
discount
tax
total
status


sale_items
----------
id
sale_id
product_id
qty
price
subtotal


payments
---------
id
sale_id
method
amount
status


purchases
----------
id
supplier_id
store_id


purchase_items
---------------
id
purchase_id
product_id
qty
price


stock_movements
---------------
id
product_id
store_id
qty
type

type:
IN
OUT
ADJUSTMENT
REFUND


audit_logs
-----------
id
user_id
action
table_name
record_id
metadata

## Flow Transaksi ##

Request checkout
        │
        ▼

Validate request

        │
        ▼

DB Transaction Begin

        │
        ▼

Check stock

        │
        ▼

lockForUpdate()

        │
        ▼

Create sale

        │
        ▼

Create sale_items

        │
        ▼

Update stock

        │
        ▼

Create payment

        │
        ▼

Insert audit log

        │
        ▼

Commit
