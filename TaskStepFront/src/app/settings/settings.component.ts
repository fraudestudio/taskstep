import { Component } from '@angular/core';

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
}
