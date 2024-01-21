import { Component, OnInit } from '@angular/core';
import { MenuItem } from 'primeng/api';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-certificates-licenses',
  templateUrl: './certificates-licenses.component.html',
  styleUrls: ['./certificates-licenses.component.css'],
})
export class CertificatesLicensesComponent implements OnInit {
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

  itemsPSDL: MenuItem[] = [
    {
      routerLink: 'service',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-1',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-2',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-3',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-4',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-5',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-6',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-7',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-8',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-9',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-10',
    },
    {
      label: ' ',
      routerLink: 'psdl-information-11',
    },
    {
      label: 'Confirmation',
      routerLink: 'psdl-confirmation',
    },
  ];

  itemsDCL: MenuItem[] = [
    {
      routerLink: 'service',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-1',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-2',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-3',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-4',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-5',
    },
    {
      label: ' ',
      routerLink: 'dcl-information-6',
    },
    {
      label: 'Confirmation',
      routerLink: 'dcl-confirmation',
    },
  ];

  itemsKPC: MenuItem[] = [
    {
      routerLink: 'service',
    },
    {
      label: ' ',
      routerLink: 'kpc-information-1',
    },
    {
      label: ' ',
      routerLink: 'kpc-information-2',
    },
    {
      label: ' ',
      routerLink: 'kpc-information-3',
    },
    {
      label: 'Confirmation',
      routerLink: 'kpc-confirmation',
    },
  ];

  constructor(private preferencesService: PreferencesService) {}

  ngOnInit(): void {
    if (
      this.preferencesService.getPreferences().currentCertFormSelected != null
    ) {
      this.items =
        this.preferencesService.getPreferences().currentCertFormSelected;
    }
  }

  onOutletLoaded(component) {
    component.parent = this;
  }

  download() {}

  print() {}

  delete() {}
}
