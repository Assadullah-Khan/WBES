#!/bin/sh

# Get currently logged in user.
user="$USER";

# Exit with a message if directory does not exist.
if [ ! -f "$PWD/.env" ]
then
	printf "\e[1;31mPlease make sure you are running this script from laravel installation root directory.\n\n\e[0m"
else
	printf "\e[1;32mChanging user group to '$user:www-data' for '$PWD'.\n\n\e[0m"
	sudo chown -R $user:www-data $PWD;

	printf "\e[1;32mSetting appropriate permissions on all files.\n\n\e[0m"
	sudo find "$PWD" -type f -exec chmod 664 {} \;

	printf "\e[1;32mSetting appropriate permissions on all sub-directories.\n\n\e[0m"
	sudo find "$PWD" -type d -exec chmod 775 {} \;

	printf "\e[1;32mChanging user group to www-data for '$PWD/storage' and '$PWD/bootstrap/cache'.\n\n\e[0m"
	sudo chgrp -R www-data "$PWD/storage";
	sudo chgrp -R www-data "$PWD/bootstrap/cache";

	printf "\e[1;32mSetting appropriate permissions on  '$PWD/storage' and '$PWD/bootstrap/cache'.\n\n\e[0m"
	sudo chmod -R ug+rwx "$PWD/storage";
	sudo chmod -R ug+rwx "$PWD/bootstrap/cache";

	if [ -f "$PWD/vendor/bin/phpunit" ]
	then
		printf "\e[1;32mSetting appropriate permissions on  '$PWD/vendor/bin/phpunit'.\n\n\e[0m"
		sudo chmod +x "$PWD/vendor/bin/phpunit";
	fi
fi
