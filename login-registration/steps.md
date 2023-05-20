*** ordine DI CREAZIONE ***

1 - index

2 - signup-include.php

3 - signup-controller-class.php

4 - db-class.php

5 - signup-class.php

6 - login-controller-class.php (copio/incollo signup-controller-class.php con qualche variazione)

7 - login-class.php (copio/incollo signup-class.php con qualche variazione)

8 - login-include.php


*** ordine LOGICO ***

SignupController extends Signup per usare i methods protected di Signup 
il quale a sua volta estende DbClass per poter usare i suoi method protected

index -> signup-include -> signup-controller-class -> signup-class -> db-class -> ooo -> ooo