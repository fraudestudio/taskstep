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
    this.contextService = new ContextService(httpClient);
  }
  
  private contextService : ContextService;

  private checkbox : boolean = true;

  private currentContext : Context = new Context("");

  get CurrentContext() : Context {
    return this.currentContext;
  }

  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };


  ngOnInit(){
    this.contextService.getContext(history.state.data).subscribe(context => this.form.title = context.Title);
    this.contextService.getContext(history.state.data).subscribe(context => this.currentContext = context);
  }


  hasReceivedInfo() : boolean{
    return this.currentContext.Id != -1;
  }


  deleteContext(){
    this.contextService.deleteContext(history.state.data).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été supprimer !", type : "confirmation"}}});    
      }
      else {
        this.router.navigate(["bycontext"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }

  submit(){
    this.contextService.modifyContext(history.state.data, this.form.title).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été modifier !", type : "confirmation"}}});
      }
      else {
        this.router.navigate(["bycontext"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }
  
}
