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
  

  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  }

  ngOnInit(): void {
    this.itemService.getItems().subscribe(items => this.listItems = items)
  }

  Print(){
    throw new Error("Method not implemented.");
  }

  get Section() {
    return history.state.data.section;
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
          if (data){
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Votre tâches est mise comme faite !", type : "confirmation"}}});
          }
          else {
              this.router.navigateByUrl('/displayItemSideBar', {state : {data : {message : "Une erreur est survenue", type : "warning"}}});
          }

      })
  }

  editItem(selectedItem: Item) {
      this.router.navigate(['/additem'],  { state: { data: { item: selectedItem } } });
  }

  deleteItem(selectedItem: Item) {
      FakeDatabase.RemoveItem(selectedItem);
  }

  get ListItems() : Item[]{
    return this.listItems;
  }

}


