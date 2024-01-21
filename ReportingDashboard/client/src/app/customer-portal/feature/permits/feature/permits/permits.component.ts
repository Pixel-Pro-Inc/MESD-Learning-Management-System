import { Component, OnInit } from '@angular/core';
import { MenuItem } from 'primeng/api';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-permits',
  templateUrl: './permits.component.html',
  styleUrls: ['./permits.component.css'],
})
export class PermitsComponent implements OnInit {
  documents = [];

  items: MenuItem[] = [
    {
      label: 'Service',
      routerLink: 'service',
    },
    {
      label: 'Information',
      routerLink: 'information',
    },
    {
      label: 'Confirmation',
      routerLink: 'confirmation',
    },
  ];

  itemsRDEP: MenuItem[] = [
    {
      routerLink: 'service',
    },
    {
      label: ' ',
      routerLink: 'rdep-information-1',
    },
    {
      label: ' ',
      routerLink: 'rdep-information-2',
    },
    {
      label: ' ',
      routerLink: 'rdep-information-3',
    },
    {
      label: ' ',
      routerLink: 'rdep-information-4',
    },
    {
      label: 'Confirmation',
      routerLink: 'rdep-confirmation',
    },
  ];

  constructor(private preferencesService: PreferencesService) {}

  ngOnInit(): void {
    if (
      this.preferencesService.getPreferences().currentPermitFormSelected != null
    ) {
      this.items =
        this.preferencesService.getPreferences().currentPermitFormSelected;
    }
  }

  onOutletLoaded(component) {
    component.parent = this;
  }

  download() {}

  print() {}

  delete() {}
}
