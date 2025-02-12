# Magento 2 Delete Order Extension by BSS Commmerce

[![License: OSI Approved :: Open Software License 3.0 (OSL-3.0)](https://img.shields.io/badge/License-OSL--3.0-blueviolet.svg)](https://opensource.org/licenses/OSL-3.0)
[![Magento 2 Compatible](https://img.shields.io/badge/Magento%202-Compatible-brightgreen.svg)](https://www.magento.com/)

Managing orders efficiently is crucial for any Magento 2 store, especially when dealing with test orders, canceled transactions, or outdated records. The **[Magento 2 Delete Order Extension](https://bsscommerce.com/magento-2-delete-order-extension.html)** by BSS Commerce provides a simple yet powerful solution to remove unnecessary orders and their associated data, ensuring a clean and organized order grid.

## Features

* **Delete Orders in Bulk or Individually**: Store admins can delete a single order or multiple orders at once, helping to maintain a cleaner order grid.
* **Remove Associated Data**: When deleting orders, this extension also removes related invoices, shipments, credit memos, and transaction history, ensuring no residual data is left behind.
* **Enable/Disable Order Deletion via Admin Panel**: Admins can control whether the delete order functionality is enabled or disabled directly from the Magento backend settings.
* **Enhance Order Management Efficiency**: By removing unnecessary orders, merchants can streamline order management, reduce clutter, and improve operational efficiency.
* **Maintain Database Performance**: Cleaning up unnecessary orders and their related data helps improve the performance of the Magento backend, reducing database load and enhancing response times.
* **User Role Restrictions**: The extension allows admins to configure role-based access to the delete order functionality, preventing unauthorized order deletions.

## Benefits

* Keep the order grid clean and manageable.
* Avoid confusion caused by test orders or canceled transactions.
* Improve Magento 2 backend performance by reducing redundant data.
* Save time by deleting multiple orders at once.

## Installation
1. Download the Delete Order Magento 2 extension from the [BSS Commerce Magento extension store](https://bsscommerce.com/magento-2-extensions.html).
2. Extract the downloaded file.
3. Upload the extracted folder to `app/code/Bss/DeleteOrder/` in your Magento root directory.
4. Navigate to the Magento root directory and run the following command:
```bash
php bin/magento setup:upgrade
```
5. Deploy static content by running:
```bash
php bin/magento setup:static-content:deploy
```
6. Clear the cache to apply the changes:
```bash
php bin/magento cache:flush
```
If you need any assistance with the installation, please feel free to contact our support team.

## Try It Yourself
Experience the **Magento 2 Delete Order Extension** in action by exploring our **[[Backend Demo luma](https://delete-order.demom2.bsscommerce.com/admin/sales/order/index/key/0eb5d7d124764507b48bb25d20bf784edc75847442a86fac1872114eb5eca182/)]** | **[[Frontend Demo Luma](https://delete-order.demom2.bsscommerce.com/)]**.

## Frequently Ask Questions

**1. How do I delete an order from Magento 2?**
Magento default does not allow to delete orders from the backend or frontend. So, to remove test orders and invoices, you need to install an extension from a third-party provider. 

**2. Can I recover deleted orders?**
No, once an order is deleted, it cannot be recovered. We recommend backing up your database before deleting orders.

**3. Does this extension remove invoices, shipments, and credit memos?**
Yes, the extension allows you to delete orders along with their related data such as invoices, shipments, and credit memos.

**4. Can I limit who can delete orders?**
Yes, you can configure admin role permissions to restrict access to the delete order functionality.

**5. Will this extension affect my order reports?**
Yes, deleted orders will no longer appear in Magento's order reports.

**6. Is this extension compatible with Magento 2.4.x?**
Yes, the Magento 2 Delete Orders extension is compatible with Magento 2.3.x and 2.4.x.




