import { Component } from '@angular/core';


@Component({
  selector: 'app-display-item-side-bar',
  templateUrl: './display-item-side-bar.component.html',
})
export class DisplayItemSideBarComponent {

  protected section : string;

  constructor() {
    this.section = history.state.data.section;
   }

}


