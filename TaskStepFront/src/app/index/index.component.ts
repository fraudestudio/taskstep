import { Component } from '@angular/core';

@Component({
  selector: 'app-index',
  templateUrl :"index.component.html"
})

export class IndexComponent {
  private taskLeft : number;

  /**
   * Array of all the tips that can be displayed
   */
  private tips : string[] = [
    'Des problèmes ? essayez la section <a href="">Aide</a>',
    'Vous pouvez lister tous les tâches par contexte ou par projet.',
    'L\'impression est conçue pour des fiches 3x5, mais vous pouvez imprimer au format A4 en allant dans Fichier->Imprimer dans votre navigateur.',
    'Sur cette page, cliquez sur une tâche de la liste immédiate pour la modifier.',
    'Vous pouvez maintenant sélectionner la date à partir d\'un calendrier. Cliquez simplement dans la case de la date comme si vous étiez en train de taper.',
  ]


  /**
   * Return if the tips can be showed
   * @returns boolean 
   */
  get ShowTips() : boolean{   
    return sessionStorage.getItem("isCheckedDisplay") == "true";
  }


  /**
   * Return a random tips of the tips array
   * @returns string of the tips
   */
  get Tips() : string {
    return this.getRandomElement(this.tips)
  }

  /**
   * return the number of task left
   * @returns number of task left
   */
  get TaskLeft() : number{
    return this.taskLeft;
  }

  constructor(){
    // Temporaire
    this.taskLeft = 0;
  }


  /**
   * Return a random element of an array
   * @param array the array of elements we want to pick
   * @returns a random element of the array
   */
  getRandomElement<T>(array: T[]): T {
    const randomIndex = Math.floor(Math.random() * array.length);
    return array[randomIndex];
  }

}
