import { Component, OnInit } from '@angular/core';
import { Context } from "src/app/model/context";
import { FakeDatabase } from '../model/FakeDatabase';
import { ContextService } from "src/service/context-service";
import { HttpClient } from '@angular/common/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-bycontext',
  templateUrl: 'bycontext.component.html'
})



export class BycontextComponent implements OnInit {

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.contextService = new ContextService(httpClient);
  }

  private contextService : ContextService;

  private contexts : Context[] = [];

  ngOnInit(){
    this.contextService.getContexts().subscribe(contexts => this.contexts = contexts);
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

  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  }

  goEditMode(id : number){
    this.router.navigate(["editcontext"], {state : {data : id}});
  }

  setEditMode(){
    this.isEditing = true;
  }

  get Contexts() : Context[]{
    return this.contexts;
  }
}
