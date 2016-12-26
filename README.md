# Magento2 Contact Map
Extension will assist in adding company or store coordinates with maps directly to the contact us page.

### Contact Us Page
<img alt="Magento2 Contact Map" src="https://karliuka.github.io/m2/contact-map/contact.png" style="width:100%"/>
### Configuration
<img alt="Magento2 Contact Map" src="https://karliuka.github.io/m2/contact-map/config.png" style="width:100%"/>
## Install with Composer as you go

1. Go to Magento2 root folder

2. Enter following commands to install module:

    ```bash
    composer require faonni/module-contact-map
    ```
   Wait while dependencies are updated.

3. Enter following commands to enable module:

    ```bash
	php bin/magento setup:upgrade
	php bin/magento setup:static-content:deploy

