import { Component, OnInit } from '@angular/core';
import { ContextService } from "src/service/context-service";
import { HttpClient } from '@angular/common/http';
import { Context } from "src/app/model/context";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-editcontext',
  templateUrl: 'editcontext.component.html'
})
export class EditcontextComponent implements OnInit {


  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.contextService = new ContextService(httpClient, router);
  }
  
  /**
   * Communiction to the API thank to the context service
   */
  private contextService : ContextService;

  /**
   * The current context to edit
   */
  private currentContext : Context = new Context("",-1);

  get CurrentContext() : Context {
    return this.currentContext;
  }

  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };

  /**
   * Init the data
   */
  ngOnInit(){
    this.contextService.getContext(history.state.data).subscribe((context) => {
      this.form.title = context.Title;
      this.currentContext = context;
    });
  }

  /**
   * Check if the info has been received
   * @returns result of the verfication
   */
  hasReceivedInfo() : boolean{
    return this.currentContext.Id != -1;
  }

  /**
   * Delete the current context
   */
  deleteContext(){
    this.contextService.deleteContext(history.state.data).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été supprimé !", type : "confirmation"}}});    
      }
      else {
        this.router.navigate(["bycontext"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }

  /**
   * Submit the modification of the current context
   */
  submit(){
    this.contextService.modifyContext(history.state.data, this.form.title).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été modifié !", type : "confirmation"}}});
      }
      else {
        this.router.navigate(["bycontext"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }
  
}