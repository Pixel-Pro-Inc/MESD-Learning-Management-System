import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-8',
  templateUrl: './psdl-information-8.component.html',
  styleUrls: ['./psdl-information-8.component.css'],
})
export class PsdlInformation8Component implements OnInit {
  @ViewChild('dataGridCmp') dataGrid: DataGridInputComponent;
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  cashflowData = {
    columns: [
      {
        field: 'lineItem',

        headerText: 'Income/Expenditure ',

        textAlign: 'Left',

        allowEditing: false,
      },
      {
        field: 'y1',

        headerText: 'Year 1',

        textAlign: 'Right',
      },
      {
        field: 'y2',

        headerText: 'Year 2',

        textAlign: 'Right',
      },
      {
        field: 'y3',

        headerText: 'Year 3',

        textAlign: 'Right',
      },
      {
        field: 'y4',

        headerText: 'Year 4',

        textAlign: 'Right',
      },
    ],
    data: [
      { lineItem: 'Tonnage sold', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Price', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Revenue', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Operating Costs', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Salaries', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Utilities', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Interest', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Rent', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Govt Levy', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Depreciation', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Other', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Total Income (Loss)', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Minus Taxes', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Add depreciation', y1: 0, y2: 0, y3: 0, y4: 0 },
      { lineItem: 'Cash flow', y1: 0, y2: 0, y3: 0, y4: 0 },
    ],
  };

  ngOnInit(): void {
    this.initializeForm();
  }

  ngAfterViewInit(): void {
    this.initExcel();
  }

  async initExcel() {
    await this.delay(100);
    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl8 != null) {
        this.cashflowData.data = prefs.certFormsPersistence.psdl8.cashFlow;
      }
    }
    this.dataGrid.setTableValues(this.cashflowData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      cashFlow: [''],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl8 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl8);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.cashFlow.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl8 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-9'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-7'
    );
  }
}
