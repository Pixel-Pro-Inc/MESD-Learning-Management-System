import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation2Component } from './psdl-information-2.component';

describe('PsdlInformation2Component', () => {
  let component: PsdlInformation2Component;
  let fixture: ComponentFixture<PsdlInformation2Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PsdlInformation2Component ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PsdlInformation2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
