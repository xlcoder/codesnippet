#!/bin/bash
#create category - wp term create category Apple --description="A type of fruit"
#wp term create category front-page-top --slug="front-page-top"
#wp term create category front-page-middle --slug="front-page-middle"
#wp term create category front-page-display --slug="front-page-display"

#create post - wp post create ./post-content.txt --post_category=201,345 --post_title='Post from file'
#wp post create /home/wordpress_fake.txt --post_category=5 --post_title='Post from file' 

#create dummy post - wp post generate --count=10 --post_type=page --post_date=1999-01-04
#wp post generate --count=2 --post_type=post  --post_content=/home/wordpress_fake.txt  

#update post $ wp post update 123 --post_name=something --post_status=draft
#wp post update 123 --post_name=something --post_status=draft

#Post Feature Image - wp media import ~/Downloads/image.png --post_id=123 --title="A downloaded picture" --featured_image""
wp media import /var/www/magitecbath/web/app/themes/magitecbath/asset/img/3-1.jpg  --post_id=178 --title="A downloaded picture" --featured_image


