import { Component, OnInit } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { Context } from "src/app/model/context";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-editcontext',
  templateUrl: 'editcontext.component.html'
})
export class EditcontextComponent implements OnInit {

  private checkbox : boolean = true;

  private currentContext : Context = new Context("");

  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };


  ngOnInit(){
    this.currentContext.Id = history.state.data.id;
    this.currentContext.Title = history.state.data.title;
    this.form.title = this.currentContext.Title;
  }

  constructor(private route: ActivatedRoute,  private router: Router){

  }

  checkBoxChanged(value : boolean){
    this.checkbox = value;
  }


  deleteContext(){
    FakeDatabase.RemoveContext(this.currentContext.Id);
    this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été supprimer !", type : "confirmation"}}});    
  }

  submit(){

    FakeDatabase.ModifyContext(this.currentContext.Id,new Context(this.form.title));
    this.router.navigate(["bycontext"], {state : {data : {message : "Votre contexte \""+ this.form.title +"\" a bien été modifier !", type : "confirmation"}}});
  }
  
}
