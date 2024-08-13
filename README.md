# Amwal Discount Auto Apply

Amwal Discount Auto Apply is a Magento 2 plugin that allows you to automatically apply discounts to the cart based on the user's eligibility.

### Using composer (Recommended)

Go to your magento root directory in your server

Require the composer package
```shell
composer require amwal/magento-discount-auto-apply:dev-main
```

## Enabling the plugin

From the command prompt or terminal run the following commands to enable the plugin:

1. Enable the module in Magento
```shell
bin/magento module:enable Amwal_Discount
```

2. Run the Magneto Setup Upgrade command, Compile DI, Deploy static content, and finally flush the cache
```shell
bin/magento setup:upgrade && \
bin/magento setup:di:compile && \
bin/magento setup:static-content:deploy && \
bin/magento cache:flush
```

## Configuring Amwal Discount Rule
To ensure that the Amwal Discount Auto Apply plugin works correctly, you need to create a specific discount rule that will be automatically applied to eligible users. Follow these steps to set up the Amwal discount rule in the Magento Admin panel:

1. Log in to Magento Admin:
   * Access your Magento Admin panel by navigating to https://your-magento-site.com/admin.
2. Navigate to Cart Price Rules:
   * In the Magento Admin sidebar, go to `Marketing > Promotions > Cart Price Rules`.
3. Create a New Rule:
   * Click on the "Add New Rule" button in the top right corner.
4. General Information:
   * Rule Name: Enter a descriptive name for your Amwal discount rule (e.g., "Amwal Payments Discount").*
   * Description: Optionally, add a description for the rule.
   * Active: Set the rule to "Yes" to activate it.
   * Websites: Select the websites where the rule should be applied.
   * Customer Groups: Select the customer groups that will be eligible for the discount.
5. Conditions:
   * In the Conditions tab, define the conditions under which the discount should be applied. For the Amwal Discount plugin to work, ensure that the rule includes a condition related to Amwal Payments.
   * Click on the green plus icon to add a new condition. Choose `Payment Method` from the options, then select the payment method related to Amwal (e.g., "Amwal Payments").
   * Example: `If Payment Method is Amwal_Payments`.
6. Actions:
   * In the Actions tab, define the discount amount and type (e.g., Percentage of product price discount, Fixed amount discount, etc.).
   * Discount Amount: Specify the discount amount you want to offer.
   * Apply To Shipping Amount: Choose whether the discount applies to the shipping amount as well.
   * Stop Further Rules Processing: Set this to "Yes" if you want to stop other rules from applying after this one.
7. Labels:
   * In the Labels tab, enter a label that will be displayed in the cart when the discount is applied.
8. Save the Rule:
   * Click on `"Save Rule"` to apply your changes.

## Testing the Discount Auto Apply
After configuring the Amwal discount rule, you can test it by placing an order:

1. Add Products to Cart:
   * Go to the storefront and add products to the cart.
2. Proceed to Checkout:
   * Begin the checkout process and select `"Amwal Payments"` as the payment method.
3. Verify Discount Application:
   * Ensure that the discount is automatically applied to the cart as per the rule you configured.
