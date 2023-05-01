import { Component, OnInit } from '@angular/core';
import { Item } from '../model/item';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';
import { ItemService } from 'src/service/item-service'
import { HttpClient } from '@angular/common/http'
import { SideBarComponent } from '../model/sideBarComponent';


@Component({
  selector: 'app-display-item-side-bar',
  templateUrl: './display-item-side-bar.component.html',
})
export class DisplayItemSideBarComponent implements OnInit {

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient) {
      this.itemService = new ItemService(httpClient, router)  
  }

  verifyDate(date : Date){
    return Number(date) <= Date.now();
  }

  /**
   * Communication with api thanks to the item service
   */
  private itemService : ItemService

  /**
   * List of the item to display
   */
  private listItems : Item[] = [];

  get ListItems() : Item[]{
    return this.listItems;
  }
  /**
   * Tells if the data is load
   */
  private isDataLoad : boolean = false;

  /**
   * The current way to sort items
   */
  private currentSort : string = "title";

  get CurrentSort() : string {
    return this.currentSort;
  }

  get IsDataLoad() : boolean{
    return this.isDataLoad;
  }

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
   * Init the data
   */
  ngOnInit(): void {
    
    // Check the sort 
    if (history.state.data?.sort){
      this.currentSort = history.state.data?.sort;
    }

    
    // Check if we need to display a section
    if (history.state.data?.section){
      this.itemService.getItemsSection(history.state.data?.section,this.currentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    // Check if we need to display a date
    else if (history.state.data?.date){
      this.itemService.getItemsDate(history.state.data?.date,this.CurrentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    // Check if we need to display a context
    else if (history.state.data?.context) {
      this.itemService.getItemsContext(history.state.data?.context,this.currentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    // Check if we need to display a project
    else if (history.state.data?.project) {
      this.itemService.getItemsProject(history.state.data?.project,this.currentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    // if it is neither of that, we display all the items
    else {
      this.itemService.getItemsAll(this.CurrentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
  }

  /**
   * Submit the changement of sort 
   */
  submit(){
    if (history.state.data?.section){
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, section : history.state.data?.section, sort : this.currentSort }}});
    }
    else if (history.state.data?.date) {
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, date : history.state.data?.date, sort : this.currentSort }}});
    }
    else if (history.state.data?.context) {
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, context : history.state.data?.context, sort : this.currentSort }}});
    }
    else if (history.state.data?.project) {
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, project : history.state.data?.project, sort : this.currentSort }}});
    }
    else {
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, sort : this.currentSort }}});
    }
  }

  /**
   * Change the current sort
   * @param value the sort to apply
   */
  sortChange(value : string){
    this.currentSort = value;
  }

  /**
   * Print the current items
   */
  Print(){
    if (history.state.data?.section){
      this.itemService.printSection(history.state.data?.section);
    }
    else if (history.state.data?.date){
      this.itemService.printToday();
    }
    else if (history.state.data?.context){
      this.itemService.printContext(history.state.data?.context);
    }
    else if (history.state.data?.project){
      this.itemService.printProject(history.state.data?.project);
    }
    else {
      this.itemService.printAll();
    }
  }

  /**
   * Get the title of the page
   */
  get Section() {
    return history.state.data.title;
  }

  /**
   * Set the selected item to done
   * @param selectedItem the selected item to set to done
   */
  doneItem(selectedItem: Item) {
        let msg = "";
        if(!selectedItem.Done){
          selectedItem.Done = true;
          msg = "Votre tâche est marquée comme faite !";
        }
        else{
          selectedItem.Done = false;
          msg = "Votre tâche est marquée comme à faire !";
        }
        this.itemService.modifyItem(selectedItem).subscribe((data) => {
          // Force a realod of the same page
          this.router.routeReuseStrategy.shouldReuseRoute = () => false;
          this.router.onSameUrlNavigation = 'reload';
          if (!data){
            if (history.state.data?.section){
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : msg, type : "confirmation", title : this.Section, section : history.state.data?.section, sort : this.currentSort}}});
            }
            else if (history.state.data?.date){
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : msg, type : "confirmation", title : this.Section, date : history.state.data?.date, sort : this.currentSort}}});
            }
            else if (history.state.data?.context) {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : msg, type : "confirmation", title : this.Section, context : history.state.data?.context, sort : this.currentSort}}});
            }
            else if (history.state.data?.project) {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : msg, type : "confirmation", title : this.Section, project : history.state.data?.project, sort : this.currentSort}}});
            }
            else {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : msg, type : "confirmation", title : this.Section, sort : this.currentSort}}});
            }
          }
          else {
            this.showError()
          }
      })

      FakeDatabase.UpdateSideBar(this.itemService);
  }

  /**
   * Display the error message
   */
  showError(){
    if (history.state.data?.section){
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, section : history.state.data?.section, sort : this.currentSort}}});
    }
    else if (history.state.data?.date){
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, date : history.state.data?.date, sort : this.currentSort}}});
    }
    else if (history.state.data?.context) {
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, context : history.state.data?.context, sort : this.currentSort}}});
    }
    else if (history.state.data?.project) {
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, project : history.state.data?.project, sort : this.currentSort}}});
    }
    else {
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, sort : this.currentSort}}});
    }
  }

  /**
   * Go the edit page for the selected item
   * @param selectedItem the item to edit
   */
  editItem(selectedItem: Item) {
      this.router.navigate(['/additem'],  { state: { data: { item: selectedItem } } });
  }

  /**
   * Delete the selected item
   * @param selectedItem the item to delete
   */
  deleteItem(selectedItem: Item) {
    this.itemService.deleteItem(selectedItem.Id).subscribe((data) =>{
      // Froce a reload
      this.router.routeReuseStrategy.shouldReuseRoute = () => false;
      this.router.onSameUrlNavigation = 'reload';
      if (!data){
        if (history.state.data?.section){
          this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche a été supprimer !", type : "confirmation", title : this.Section, section : history.state.data?.section, sort : this.currentSort}}});
        }
        else if (history.state.data?.date){
          this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche a été supprimer !", type : "confirmation", title : this.Section, date : history.state.data?.date, sort : this.currentSort}}});
        }
        else if (history.state.data?.context) {
          this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche a été supprimer !", type : "confirmation", title : this.Section, context : history.state.data?.context, sort : this.currentSort}}});
        }
        else {
          this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche a été supprimer !", type : "confirmation", title : this.Section, sort : this.currentSort}}});
        }
      }
      else {
        this.showError()
      }
    })

    FakeDatabase.UpdateSideBar(this.itemService);
  }



}


