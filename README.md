## About Project

This project aim to solve tasks of employment process of company to measure my problem solving skills and other some skills also so we need to read some hints below to understand benefits of this tasks.

### Part One

-   Skip number five problem.
-   get index of string in series problem.
-   minimum steps to reach to zero problem.

### Part two

-   login api endpoint.
-   registration endpoint.
-   update user information endpoint.
-   get all users endpoint.
-   get info of a specific user endpoint.
-   delete user by api_token of user endpoint.

## Considerations

-   **I didn't make a validation in problems of part one that means i expect that the input has a correct format.**

## approaches

-   **Skip number five problem** (first problem in part one)

    Expected to send two variable (with names `begin` and `end`) in GET endpoint represent beginning and end of the range and this variables have integer values so code just have `IF Condition` in for loop.

-   **Get index of string** (second problem in part one)

    I solved this problem depends on how to calculate difference between each character and `A` thats mean (Each character in this string must be an uppercase character) thats occurred after reversing string and multiply this difference in (26 ^ (index of current character) )

    -   Example:-

        AAA => (A-A+1)\*(26^0) + (A-A+1)\*(26^1) + (A-A+1)\*(26^2) = 1 + 26 + 676 = 703

-   **Minimum steps to zero** (third problem in part one)

    Best solution for this problem is trying to get all divisors for each number and if number is prime we must other way that require to subtract only from number and also try to getting divisors of new number and continue in the process until reaching to zero

    -   best way to get divisors is using O(sqrt(number)) algorithm to improve solution as much as we can
    -   method is POST here not GET
    -   make sure that ( `N` is a number and `Q` is array of integers )
