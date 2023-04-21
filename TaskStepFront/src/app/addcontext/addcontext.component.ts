import { Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
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

  constructor(private route: ActivatedRoute,  private router: Router){
    
  }


  submit(){
    FakeDatabase.AddContext(new Context(this.form.title));
    this.router.navigate(["bycontext"], {state : {data : { message : "Votre contexte \""+ this.form.title +"\" a bien été ajouter !", type : "confirmation"}}});
  }
}
