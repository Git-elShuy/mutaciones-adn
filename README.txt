Colocar el proyecto en la carpeta htdocs de xampp, abrimos esa ruta en vscode
en la terminal de vscode corremos la mini api con el comando php artisan serve.


Para probar los endpoints en la instancia de aws:

en el navegador o postman

http://3.145.4.3:8000/api/list
http://3.145.4.3:8000/api/stats
http://3.145.4.3:8000/api/mutation -> este es un post asi que debe llevar un parametro
{
  "adn": ["ATGCGA", "CAGTGC", "TTATGT", "AGAAGG", "CCCCTA", "TCACTG"]
} 