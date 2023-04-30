import { Component } from '@angular/core';
import { ContextService } from "src/service/context-service";
import { HttpClient } from '@angular/common/http';
import { Context } from "src/app/model/context";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-addcontext',
  templateUrl: 'addcontext.component.html'
})
export class AddcontextComponent {

  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.contextService = new ContextService(httpClient, router);
  }

  /**
   * Comunication with the api thanks to the context service
   */
  private contextService : ContextService;

  /**
   * Add a context with the given informations
   */
  submit(){
    this.contextService.addContext(this.form.title).subscribe((data) =>
      {
        if (data != null){
          this.router.navigate(["bycontext"], {state : {data : { message : "Votre contexte \""+ this.form.title +"\" a bien été ajouter !", type : "confirmation"}}});     
        }
        else {
          this.router.navigate(["bycontext"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
        }
      }
    );
  }
}
