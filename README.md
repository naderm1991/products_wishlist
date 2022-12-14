## Backend Assignment

## Task
You were given a sample [Laravel][laravel] project which implements sort of a personal wishlist
where user can add their wanted products with some basic information (price, link etc.) and
view the list.

#### Refactoring
The `ItemController` is messy. Please use your best judgement to improve the code. Your task
is to identify the imperfect areas and improve them whilst keeping the backwards compatibility.

#### New feature
Please modify the project to add statistics for the wishlist items. Statistics should include:

- total items count
- average price of an item
- the website with the highest total price of its items
- total price of items added this month

The statistics should be exposed using an API endpoint. **Moreover**, user should be able to
display the statistics using a CLI command.

Please also include a way for the command to display a single information from the statistics,
for example just the average price. You can a dd a command parameter/option to specify which
statistic should be displayed.

## Open questions
Please write your answers to following questions.

> **Please briefly explain your implementation of the new feature**  
>  
> 1- I added new controller called statistics with index endpoint and inside it I did the following:
>   a- get the count of the items using count function
>   b- get the price average from model avg function
>   c- add new model function for the highest total price website "I used grouping to get the value"
>   d- add new model function for the total price of items this month "
> 
> 2- please use the following command to get the statistics
>    php artisan statistics:show --name=count
>       name is one of the following values: count / average / max_url / this_month_price_total
> _..._

> **For the refactoring, would you change something else if you had more time?**  
>  
> _..._

## Running the project
This project requires a database to run. For the server part, you can use `php artisan serve`
or whatever you're most comfortable with.

You can use the attached DB seeder to get data to work with.

#### Running tests
The attached test suite can be run using `php artisan test` command.

[laravel]: https://laravel.com/docs/8.x
#   p r o d u c t s _ w i s h l i s t 
 
 