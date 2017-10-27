<?php

namespace LCB\DateFormatPatch\Plugin;

class Timezone {

    /**
     * @var \Magento\Framework\Locale\ResolverInterface
     */
    protected $_localeResolver;
    
    /**
     * @var array
     */
    public $intlDateFormatterShortPatterns = [
        'pl_PL' => 'dd.MM.y'
    ];

    /**
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     */
    public function __construct(
        \Magento\Framework\Locale\ResolverInterface $localeResolver
    ) {
        $this->_localeResolver = $localeResolver;
    }
    
    /**
     * Workaround for not strict lib-icu behaviour
     * 
     * @see https://stackoverflow.com/questions/23272929/intldateformatter-return-a-wrong-pattern
     */
    public function aroundGetDateFormat(
            $subject, 
            callable $proceed, 
            $type = \IntlDateFormatter::SHORT)
    {

        $locale = $this->_localeResolver->getLocale();
        if ($type == \IntlDateFormatter::SHORT && isset($this->intlDateFormatterShortPatterns[$locale])) {            
            return $this->intlDateFormatterShortPatterns[$locale];
        }
        
        return $proceed($type);
        
    }

}
