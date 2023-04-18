import { Component } from '@angular/core';
import { ThemeService } from '../theme/theme.service';

@Component({
  selector: 'app-settings',
  templateUrl: 'settings.component.html'
})
export class SettingsComponent {


  get isDisplayChecked() : boolean {
    return (sessionStorage.getItem("isCheckedDisplay") == "true");
  }

  onCheckedChange(value : boolean) {
    sessionStorage.setItem("isCheckedDisplay", String(value));
  }

  isCurrentThemeEqual(value : string){
    return value == ThemeService.getStoredTheme();
  }

  onThemeChange(value : string){
    ThemeService.setTheme(value);
  }
}
