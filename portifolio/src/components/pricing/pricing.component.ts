import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class PricingComponent extends Vue
{
    @Prop() private msg!: string;
}
