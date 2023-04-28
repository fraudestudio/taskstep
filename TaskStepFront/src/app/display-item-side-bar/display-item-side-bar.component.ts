import { Component } from '@angular/core';
import { Item } from '../model/item';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';
import { SideBarComponent } from '../model/sideBarComponent';


@Component({
  selector: 'app-display-item-side-bar',
  templateUrl: './display-item-side-bar.component.html',
})
export class DisplayItemSideBarComponent {

  protected section : string;
  
  constructor(private route: ActivatedRoute,  private router: Router) {
    this.section = history.state.data.section;
   }


  Print(){
    throw new Error("Method not implemented.");
  }

  doneItem(selectedItem: Item) {
        if(selectedItem.Done == false){
          selectedItem.Done = true;   
        }
        else{
          selectedItem.Done = false;
        }
        FakeDatabase.ModifyItem(selectedItem);
  }

  editItem(selectedItem: Item) {
      this.router.navigate(['/additem'], { state: { data: { item: selectedItem } } });
  }

  deleteItem(selectedItem: Item) {
      FakeDatabase.RemoveItem(selectedItem);
  }

  protected ListItems : Item[] = FakeDatabase.GetAllItems();

}


