import { Component, Input } from '@angular/core';
import { Context } from "src/app/model/context";
import { FakeDatabase } from '../model/FakeDatabase';

@Component({
  selector: 'app-bycontext',
  templateUrl: 'bycontext.component.html'
})



export class BycontextComponent {

  message : string = history.state.data;

  get Contexts() : Context[]{
    return FakeDatabase.Contexts;
  }
}
