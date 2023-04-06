import { formatDate } from '@angular/common';
import { Component } from '@angular/core';

@Component({
  selector: 'app-navigation-bar',
  template: `
    <div id = "container">
    <!--Header-->
    <div id="header"> 
      <h1><img src="assets/icon.png" alt="" style="vertical-align:middle"/>&nbsp;<a href="index.php">TaskStep <span class="subtitle">1.1</span></a></h1>
    </div>
    <div id="headernav">
	    <ul>
		    <li><img src="assets/calendar_view_day.png" alt="" />Aujourd'hui : {{date | date : 'dd LLLL yyyy' }}</li>
		    <li><img src="assets/house.png" alt="" /></li>
		    <li><img src="assets/page_white_text.png" alt="" /></li>
		    <li><img src="assets/context.png" alt="" /></li>
		    <li><img src="assets/project.png" alt="" /></li>
		    <li><img src="assets/textfield_rename.png" alt="" /></li>
		    <li><img src="assets/help.png" alt="" /></li>
		    <li><img src="assets/door_in.png" alt="" /></li>
	</ul>
</div>
  `,
  styles: [
  ]
})
export class NavigationBarComponent {
    date = Date.now();
}
