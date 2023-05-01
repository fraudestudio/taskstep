# À propos des fichiers de traduction

## Format

Un fichier de traduction doit être nommé « *id*.php » où *id* est le code du langage cible.
Il ne doit contenir qu'une seule déclaration: un `return` qui revoie un tableau associatif.

Le tableau est structuré de la manière suivante:
```php
[
  'section' => [
  	'texte1' => 'Texte 1',
  	'texte2' => 'Texte 2',
  	...
  ],
  ...
]
```

Le texte peut contenir des balises HTML et des balises de formatage.

## Commentaire des fichiers originaux:

> The language system uses variables for every sentence that needs to be translated.
> If you want to contribute a translation, just replace each sentence accordingly.
> Please consider sharing new translations by creating a pull request on GitHub.
>
> Longer sections which include paragraphs include HTML. Single words or sentences do not.
> Just edit the bits in quotes to change what appears as text.