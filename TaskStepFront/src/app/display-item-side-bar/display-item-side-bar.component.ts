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

  private itemService : ItemService

  private listItems : Item[] = [];
  
  private isDataLoad : boolean = false;

  private currentSort : string = "title";

  get CurrentSort() : string {
    return this.currentSort;
  }

  get IsDataLoad() : boolean{
    return this.isDataLoad;
  }

  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  }

  ngOnInit(): void {
    
    if (history.state.data?.sort){
      this.currentSort = history.state.data?.sort;
    }

    

    if (history.state.data?.section){
      this.itemService.getItemsSection(history.state.data?.section,this.currentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    else if (history.state.data?.date){
      this.itemService.getItemsDate(history.state.data?.date,this.CurrentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    else if (history.state.data?.context) {
      this.itemService.getItemsContext(history.state.data?.context,this.currentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
    else {
      this.itemService.getItemsAll(this.CurrentSort).subscribe((items) => {this.listItems = items; this.isDataLoad = true})
    }
  }


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
    else {
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : this.Section, sort : this.currentSort }}});
    }

  }

  sortChange(value : string){
    this.currentSort = value;
  }

  Print(){
    throw new Error("Method not implemented.");
  }

  get Section() {
    return history.state.data.title;
  }

  doneItem(selectedItem: Item) {
        if(selectedItem.Done == false){
          selectedItem.Done = true;   
        }
        else{
          selectedItem.Done = false;
        }
        this.itemService.modifyItem(selectedItem).subscribe((data) =>{
          this.router.routeReuseStrategy.shouldReuseRoute = () => false;
          this.router.onSameUrlNavigation = 'reload';
          if (!data){
            if (history.state.data?.section){
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche est mise comme faite !", type : "confirmation", title : this.Section, section : history.state.data?.section, sort : this.currentSort}}});
            }
            else if (history.state.data?.date){
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche est mise comme faite !", type : "confirmation", title : this.Section, date : history.state.data?.date, sort : this.currentSort}}});
            }
            else if (history.state.data?.context) {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche est mise comme faite !", type : "confirmation", title : this.Section, context : history.state.data?.context, sort : this.currentSort}}});
            }
            else {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâche est mise comme faite !", type : "confirmation", title : this.Section, sort : this.currentSort}}});
            }
          }
          else {
            this.showError()
          }
      })
  }


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
    else {
      this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning", title : this.Section, sort : this.currentSort}}});
    }
  }

  editItem(selectedItem: Item) {
      this.router.navigate(['/additem'],  { state: { data: { item: selectedItem } } });
  }

  deleteItem(selectedItem: Item) {
    this.itemService.deleteItem(selectedItem.Id).subscribe((data) =>{
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
  }

  get ListItems() : Item[]{
    return this.listItems;
  }

}


