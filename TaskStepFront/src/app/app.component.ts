import { Component } from '@angular/core';
import { ThemeService } from './theme/theme.service';

@Component({
  selector: 'app-root',
  templateUrl : 'app.component.html'
})

export class AppComponent {
  constructor(){
    ThemeService.setInitialTheme();
  }
}
