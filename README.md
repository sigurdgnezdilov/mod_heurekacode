# Mod_heurekacode
Přidává heureka kod ke každému produktu, pomocí polymorfní tabulky PMstring.
Balíček pracuje s Kontrolerem, Modelem, Repozitářem a pohledy.

<strong>
! Důležité ! V této verzi si po sobě balíčkovač neuklidí. Proto je nutné po odinstalaci 
balíčku smazat data z DB (Pokud si data nechcete ponechat). Data jsou uložena v PMstring tabulce s ColumnName "heureka"
.

! Důležité ! V této verzi balíčkovač pracuje jenom s přetíženými kontrolery, tzn. Nové kontrolery nebudou načtené.

</strong> 

Fileshema :
-
    src ->  
        -> Controllers
            ->backend
                -> catalog
                    -> ProductController.php
        -> Models
            -> Product.php
            -> Repository
                -> ProductRepository.php
        -> Resources   
            ->backend
                -> catalog
                    -> products
                        -> components
                            -> form_main.blade.php
                        -> create.blade.php
                        -> edit.blade.php
                        -> list.blade.php
                        -> show.blade.php
                        

Popis funkce balíčku
-
1. Repozitar : <br />
    Aby se produkty ukládaly správně je třeba kompletně zkopírovat celý obsah repozitáře pro produkt
    a přidat ukládání heureka kódu do DB (radek repozitare 59, 162). Repozitar dedi vsechny metody z originalu.
    Při přetěžování metod v repozitáři je nutné zachovat jak výstupní tak vstupní konzistenci. Stejné datové typy 
    i případné namespaces.
2. Model : <br />
    dedi vsechny metody z originalu, navic jsou pridane metody pro praci s heureka kodem.
3. Kontroler :<br />
    Obsahuje create a update pretizene metody. Je nutné si dát pozor aby metody vracely 
    stejné návratové hodnotnoy jako rodic, vcetne vstupnich parametru.
    
      