import { Component } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';
import { Item } from "src/app/model/item";
import { Context } from "src/app/model/context";
import { Project } from "src/app/model/project";
import { SideBarComponent } from '../model/sideBarComponent';

@Component({
    selector: 'app-additem',
    templateUrl : 'additem.component.html'
})

export class AdditemComponent {



submit() {
    throw new Error('Method not implemented.');
}
 


private sections : SideBarComponent[] = FakeDatabase.GetSideBar();

/**
* Information of the form
*/
  form : any  = {
      title : null,
      note : null,
      section : this.sections[0],
      context : null,
      project : null,
      dueDate : null,
      url : null
  
  };

    /**
     * method that returns the section 
     * @param id the id of the section
     * @returns the name of the section
     */
    protected Section(id :number) : string {
        return this.sections[id].toString();   
    }

    /**
     * Property that returns the sections
     * @returns the sections
     */
    get Sections() : SideBarComponent[] { return this.sections;  }

    get Contexts() : Context[] {  return FakeDatabase.Contexts;  }

    get Projects() : Project[] {  return FakeDatabase.Projects;  }

    
    editContext(){
        this.router.navigate(["editcontext"]);
    }
    
    editProject(){
        this.router.navigate(['editproject']);
    }
   
    constructor(private route: ActivatedRoute,  private router: Router){    
    
    }
    
    }

    


