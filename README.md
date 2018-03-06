# The "MadePeople Decimator" module for Magento Community Edition v1.x

When an order is fully paid, module stores the order ID and the paid total sum multiplied by a decimal factor.

Once installed, module creates:
* the "madepeople_decimator_log" table, with structure as shown here https://goo.gl/S7kDVr and here https://gist.github.com/ajzele/0b89af97fd31550f99a76abbe1d0142c
* the configuration area under Magento admin > System > Configuration > Sales > Sales > MadePeople Decimator, as shown here https://goo.gl/Sosv7d and here https://goo.gl/H22Jt7

Module triggers on "sales_order_invoice_pay" event, which then logs only those orders whose base total due is zero, as this seems to be the most correct way of determining if order is paid in full.

Developed and tested on Magento Community Edition ver. 1.9.1.0.