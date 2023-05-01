import { Component, OnInit } from '@angular/core';
import { Item } from '../model/item';
import { ItemService } from 'src/service/item-service';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { formatDate } from '@angular/common';
import { FakeDatabase } from '../model/FakeDatabase';

@Component({
  selector: 'app-index',
  templateUrl :"index.component.html"
})

export class IndexComponent implements OnInit {
  
  constructor(private router: Router, private httpClient : HttpClient){  
    this.itemService = new ItemService(httpClient, router);
    this.taskLeft = 0;
  }

  /**
   * Get all the infromation
   */
  ngOnInit(): void {
    this.itemService.getItemBeforeToday(formatDate(Date.now(),"dd-MM-yyy","fr-Fr")).subscribe((items) => {this.allItem = items; this.isDataLoad = true});
    this.itemService.getUndone().subscribe((data) => this.taskLeft = data );
  }


  private taskLeft : number;

  /**
   * return the number of task left
   * @returns number of task left
   */
  get TaskLeft() : number{
    return this.taskLeft;
  }

  /**
   * Communication with the api thanks to ItemService
   */
  private itemService : ItemService;

  /**
   * Sotre if all the data are load
   */
  private isDataLoad : boolean = false
  /**
   * Return if all the data are load
   * @returns the response of the verification
   */
  DataIsLoad(){
    return this.isDataLoad;
  }

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
   * Get the number of immediate data
   */
  get DataNumber() : number {
    let total = 0;
    this.AllItem.forEach(element => {
      if (!element.Done){
        total++
      }
    });
    return total;
  }



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
   * Message to display if there is any
   */
  get message() : string {
    return history.state.data?.message; 
  }

  /**
   * Type of the message to display if there is any
   */
  get type() : string {
    return history.state.data?.type;
  }

  /**
   * All the item to display
   */
  private allItem : Item[] = []

  /**
   * Get all the item needed for immediate task
   */
  get AllItem() : Item[]{
    return this.allItem;

  }

/**
 * Go to the edit page for the selected item
 * @param selectedItem the selected item
 */
editItem(selectedItem: Item) {
    this.router.navigate(['/additem'],  { state: { data: { item: selectedItem } } });
}

/**
 * Mark the selected item as done
 * @param selectedItem the selected item
 */
doneItem(selectedItem : Item){
    if(!selectedItem.Done){
      selectedItem.Done = true;   
    }
    else{
      selectedItem.Done = false;
    }
    this.itemService.modifyItem(selectedItem).subscribe((data) =>{
      this.router.routeReuseStrategy.shouldReuseRoute = () => false;
      this.router.onSameUrlNavigation = 'reload';
      if (!data){
        this.router.navigate(["index"], {state : {data : { message : "La tâche \""+selectedItem.Title+"\" est faite !", type:"confirmation"}}});     
      }
      else {
        this.router.navigate(["index"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    })
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
