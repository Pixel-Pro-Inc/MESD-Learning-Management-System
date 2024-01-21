import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation3Component } from './psdl-information-3.component';

describe('PsdlInformation3Component', () => {
  let component: PsdlInformation3Component;
  let fixture: ComponentFixture<PsdlInformation3Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation3Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation3Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
