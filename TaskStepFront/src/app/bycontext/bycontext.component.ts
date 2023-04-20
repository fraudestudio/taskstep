import { Component, Input } from '@angular/core';
import { Context } from "src/app/model/context";
import { FakeDatabase } from '../model/FakeDatabase';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-bycontext',
  templateUrl: 'bycontext.component.html'
})



export class BycontextComponent {

  constructor(private route: ActivatedRoute,  private router: Router){  
  }

  get Title() : string {
    if (this.isEditing){
      return "Choissisez un contexte à modifier ou ajouter un contexte."
    }
    else {
      return "Choissisez un contexte pour afficher les tâches qui lui sont liés. Vous pouvez aussi ajouter/éditer un contexte."
    }
  }



  private isEditing : boolean = false;

  get IsEditing() : boolean {
    return this.isEditing;
  }

  message : string = history.state.data;


  goEditMode(context : Context){
    this.router.navigate(["editcontext"], {state : {data : context}});
  }

  setEditMode(){
    this.isEditing = true;
  }

  get Contexts() : Context[]{
    return FakeDatabase.Contexts;
  }
}
