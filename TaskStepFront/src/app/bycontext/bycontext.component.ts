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
    this.contextService = new ContextService(httpClient, router);
  }

  /**
   * Communication to the api thanks to the context service
   */
  private contextService : ContextService;

  /**
   * The contexts to display
   */
  private contexts : Context[] = [];
  
  get Contexts() : Context[]{
    return this.contexts;
  }

  /**
   * Init data
   */
  ngOnInit(){
    this.contextService.getContexts().subscribe(contexts => this.contexts = contexts);
  }

  /**
   * Title to display
   */
  get Title() : string {
    if (this.isEditing){
      return "Choissisez un contexte à modifier ou ajouter un contexte."
    }
    else {
      return "Choissisez un contexte pour afficher les tâches qui lui sont liés. Vous pouvez aussi ajouter/éditer un contexte."
    }
  }


  /**
   * Tells if the page is in edit mode or not
   */
  private isEditing : boolean = false;

  get IsEditing() : boolean {
    return this.isEditing;
  }

  /**
   * Message to display if there is any
   */
  get message() : string {
    return history.state.data?.message; 
  }

  /**
   * Type of message to display if there is any
   */
  get type() : string {
    return history.state.data?.type;
  }

  /**
   * Redirect to edit section with clicked project
   * @param id id of the project
   */
  goEditMode(id : number){
    this.router.navigate(["editcontext"], {state : {data : id}});
  }

  /**
   * Redirec to the item section of the project
   * @param id id of the project
   * @param title title of the project
   */
  goItem(id : number, title : string){
    this.router.navigate(["displayItemSideBar"], { state : {data : { title : title, context : id }}});
  }

  /**
   * Set the page to edit mode
   */
  setEditMode(){
    this.isEditing = true;
  }
}
